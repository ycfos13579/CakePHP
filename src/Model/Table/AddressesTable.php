<?php
// src/Model/Table/AddressesTable.php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class AddressesTable extends Table
{
    public function initialize(array $config) {
        parent::initialize($config);
        $this->addBehavior('Translate', ['fields' => ['title', 'body']]);
        $this->setTable('addresses');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Customers', [
            'foreignKey' => 'address_id'
        ]);
        $this->belongsToMany('Tags', [
            'foreignKey' => 'address_id',
            'targetForeignKey' => 'tag_id',
            'joinTable' => 'addresses_tags'
        ]);

        $this->belongsToMany('Files', [
            'foreignKey' => 'address_id',
            'targetForeignKey' => 'file_id',
            'joinTable' => 'addresses_files'
        ]);
    }
    
    public function validationDefault(Validator $validator) {
        $validator
                ->integer('id')
                ->allowEmpty('id', 'create');

        $validator
                ->scalar('title')
                ->maxLength('title', 255)
                ->requirePresence('title', 'create')
                ->notEmpty('title');

        $validator
                ->scalar('slug')
                ->maxLength('slug', 191)
                ->requirePresence('slug', 'create')
                ->notEmpty('slug')
                ->add('slug', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
                ->scalar('body')
                ->allowEmpty('body');

        $validator
                ->boolean('published')
                ->allowEmpty('published');

        return $validator;
    }
    
     public function buildRules(RulesChecker $rules) {
        $rules->add($rules->isUnique(['slug']));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
    
    public function findTagged(Query $query, array $options)
    {
        $columns = [
            'Addresses.id', 'Addresses.user_id', 'Addresses.title',
            'Addresses.body', 'Addresses.published', 'Addresses.created',
            'Addresses.slug',
        ];

        $query = $query
            ->select($columns)
            ->distinct($columns);

        if (empty($options['tags'])) {
            // If there are no tags provided, find addresses that have no tags.
            $query->leftJoinWith('Tags')
                ->where(['Tags.title IS' => null]);
        } else {
            // Find addresses that have one or more of the provided tags.
            $query->innerJoinWith('Tags')
                ->where(['Tags.title IN' => $options['tags']]);
        }

        return $query->group(['Addresses.id']);
    }
    
}
    
    /*public function beforeSave($event, $entity, $options)
    {   
        if ($entity->tag_string) {
        $entity->tags = $this->_buildTags($entity->tag_string);
        }
        if ($entity->isNew() && !$entity->slug) {
            $sluggedTitle = Text::slug($entity->title);
            // trim slug to maximum length defined in schema
            $entity->slug = substr($sluggedTitle, 0, 191);
        }
    }*/
    /*protected function _buildTags($tagString)
    {
        // Trim tags
        $newTags = array_map('trim', explode(',', $tagString));
        // Remove all empty tags
        $newTags = array_filter($newTags);
        // Reduce duplicated tags
        $newTags = array_unique($newTags);

        $out = [];
        $query = $this->Tags->find()
            ->where(['Tags.title IN' => $newTags]);

        // Remove existing tags from the list of new tags.
        foreach ($query->extract('title') as $existing) {
            $index = array_search($existing, $newTags);
            if ($index !== false) {
                unset($newTags[$index]);
            }
        }
        // Add existing tags.
        foreach ($query as $tag) {
            $out[] = $tag;
        }
        // Add new tags.
        foreach ($newTags as $tag) {
            $out[] = $this->Tags->newEntity(['title' => $tag]);
        }
        return $out;
    }*/
    
     
    
   
    
    

