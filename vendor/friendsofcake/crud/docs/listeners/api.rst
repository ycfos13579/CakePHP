API
===

This listener allows you to easily create a JSON or XML Api built on top of Crud.

Introduction
^^^^^^^^^^^^

The ``API listener`` depends on the ``RequestHandler`` to be loaded **before** ``Crud``

[Please also see the CakePHP documentation on JSON and XML views]
(http://book.cakephp.org/2.0/en/views/json-and-xml-views.html#enabling-data-views-in-your-application)

Setup
^^^^^

Routing
-------

You need to tell the ``Router`` to parse extensions else it won't be able to
process and render ``json`` and ``xml`` URL extension

.. code-block:: phpinline

  // config/routes.php
  Router::extensions(['json', 'xml']);

Ensure this statement is used before connecting any routes.

Controller
----------

Attach it on the fly in your controller beforeFilter, this is recommended if
you want to attach it only to specific controllers and actions

.. code-block:: php

  <?php
  class SamplesController extends AppController {

    public function beforeFilter(\Cake\Event\Event $event) {
      parent::beforeFilter();
      $this->Crud->addListener('Crud.Api');
    }
  }

Attach it using components array, this is recommended if you want to
attach it to all controllers, application wide

.. code-block:: php

  <?php
  class AppController extends Controller {

    public $components = [
      'RequestHandler',
      'Crud.Crud' => [
        'actions' => ['Crud.Index', 'Crud.View'],
        'listeners' => ['Crud.Api']
      ]
    ];

  }

New CakeRequest detectors
^^^^^^^^^^^^^^^^^^^^^^^^^

The Api Listener creates 3 new detectors in your ``CakeRequest`` object.

is('json')
----------

Checks if the extension of the request is ``.json`` or if the requester accepts
json as part of the ``HTTP accepts`` header

is('xml')
---------

Checks if the extension of the request is ``.xml`` or if the requester accepts
XML as part of the ``HTTP accepts`` header

is('api')
---------

Checking if the request is either ``is('json')`` or ``is('xml')``

Default behavior
^^^^^^^^^^^^^^^^

If the current request doesn't evaluate ``is('api')`` to true, the listener
won't do anything at all.

All it's callbacks will simply return ``NULL`` and don't get in your way.

Exception handler
^^^^^^^^^^^^^^^^^

The Api listener overrides the ``Exception.renderer`` for ``api`` requests,
so in case of an error, a standardized error will be returned, in either
``json`` or ``xml`` - according to the API request type.

Request type enforcing
^^^^^^^^^^^^^^^^^^^^^^

The API listener will try to enforce some best practices on how an API
should behave.

For a request to ``index`` and ``view`` the HTTP request type **must** be
``HTTP GET`` - else an ``MethodNotAllowed`` exception will be raised.

For a request to ``add`` the HTTP request type **must** be ``HTTP POST`` -
else an ``MethodNotAllowed`` exception will be raised.

For a request to ``edit`` the HTTP request type **must** be ``HTTP PUT`` -
else an ``MethodNotAllowed`` exception will be raised.

For a request to ``delete`` the HTTP request type **must** be ``HTTP DELETE`` -
else an ``MethodNotAllowed`` exception will be raised.

Response format
^^^^^^^^^^^^^^^

The default response format for both XML and JSON is two root keys,
``success`` and ``data``.

It's possible to add your own root keys simply by ``_serialize`` view var.

JSON
----

.. code-block:: json

  {
    "success": true,
    "data": {

    }
  }


XML
---

.. code-block:: xml

  <response>
    <success>1</success>
    <data></data>
  </response>


Exception response format
^^^^^^^^^^^^^^^^^^^^^^^^^

The ``data.exception`` key is only returned if ``debug`` is > 0

JSON
----

.. code-block:: json

  {
    "success": false,
    "data": {
      "code": 500,
      "url": "/some/url.json",
      "name": "Some exception message",
      "exception": {
        "class": "CakeException",
        "code": 500,
        "message": "Some exception message",
        "trace": []
      }
    }
  }


XML
---

.. code-block:: xml

  <response>
    <success>0</success>
    <data>
      <code>500</code>
      <url>/some/url.json</url>
      <name>Some exception message</name>
      <exception>
        <class>CakeException</class>
        <code>500</code>
        <message>Some exception message</message>
        <trace></trace>
        <trace></trace>
      </exception>
      <queryLog/>
    </data>
  </response>


HTTP POST (add)
^^^^^^^^^^^^^^^

``success`` is based on the ``event->subject->success`` parameter from the
``Add`` action.

If ``success`` is ``false`` a HTTP response code of ``412`` will be returned,
along with a list of validation errors from the model in the ``data`` property
of the response body.

If ``success`` is ``true`` a HTTP response code of ``201`` will be returned,
along with the id of the created record in the ``data`` property of the
response body.

HTTP PUT (edit)
^^^^^^^^^^^^^^^

``success`` is based on the ``event->subject->success`` parameter from the
``Edit`` action.

If ``success`` is ``false`` a HTTP response code of ``412`` will be returned,
along with a list of validation errors from the model in the ``data`` property
of the response body.

If ``success`` is ``true`` a HTTP response code of ``200`` will be returned
(even when the resource has not been updated).

HTTP DELETE (delete)
^^^^^^^^^^^^^^^^^^^^

``success`` is based on the ``event->subject->success`` parameter from
the ``Delete`` action.

If ``success`` is ``false`` a HTTP response code of ``400`` will be returned.

If ``success`` is ``true`` a HTTP response code of ``200`` will be returned,
along with empty ``data`` property in the response body.

Not Found (view / edit / delete)
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

In case an ``id`` is provided to a crud action and the id does not exist in
the database, a ``404`` NotFoundException` will be thrown.

Invalid id (view / edit / delete)
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

In case a ``ìd`` is provided to a crud action and the id is not valid
according to the database type a ``500 BadRequestException`` will be thrown
