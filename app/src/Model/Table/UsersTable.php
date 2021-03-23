<?php
// src/Model/Table/ArticlesTable.php
namespace App\Model\Table;
use Cake\ORM\Table;
// the Text class
use Cake\Utility\Text;
// the EventInterface class
use Cake\Event\EventInterface;
use Cake\Validation\Validator;
use Cake\Utility\Hash;
use Cake\Auth\DefaultPasswordHasher;
class UsersTable extends Table
{
    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp');
    }
    public function beforeSave(EventInterface $event, $entity, $options)
    {
        // if ($entity->isNew() && !$entity->password) {
        //     $sluggedTitle = Text::slug($entity->email);
        //     // trim slug to maximum length defined in schema
        //     $entity->slug = substr($sluggedTitle, 0, 191);
        // }
        //$entity->password = return (new DefaultPasswordHasher)->hash($entity->password);
    }
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->notEmptyString('email')
            ->minLength('email', 10)
            ->maxLength('email', 255)

            ->notEmptyString('password')
            ->minLength('password', 3)
            ->maxLength('password', 32);

        return $validator;
    }
}