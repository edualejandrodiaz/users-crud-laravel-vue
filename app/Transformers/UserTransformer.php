<?php

namespace App\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    // protected $defaultIncludes = [
    //     //
    // ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    // protected $availableIncludes = [
    //     //
    // ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
         return [
            'identificador' => (int)$user->id,
            'grupo_cliente_id' => (int)$user->customer_group_id,
            'invitado' => (int)$user->invitado,
            'nombre' => (string)$user->firstname, 
            'apellido' => (string)$user->lastname,
            'correo' => (string)$user->email,
            'rut' => (string)$user->rut,
            'telefono' => (string)$user->telephone,
            'salt' => (string)$user->salt,
            'nacimiento' => (string)$user->nacimiento,
            'address_id' => (int)$user->address_id,
            'ip' => (string)$user->ip,
            'newsletter' => (int)$user->newsletter,
            'status' => (int)$user->status,
            'approved' => (int)$user->approved,
            'esVerificado' => (int)$user->verified,
            'timestamp' => (int)$user->timestamp,
            'legado' => (int)$user->legado,
            'esAdministrador' => ($user->admin === 'true'),
            'fechaCreacion' => (string)$user->created_at,
            'fechaActualizacion' => (string)$user->updated_at,
            'fechaEliminacion' => isset($user->deleted_at) ? (string) $user->deleted_at : null,

            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('users.show', $user->id),
                ],
            ],
        ];   
    }

    

    public static function originalAttribute($index)
    {
        $attributes = [
            'identificador'         => 'id',
            'grupo_cliente_id'      => 'customer_group_id',
            'invitado'              => 'invitado',
            'nombre'                => 'firstname',
            'apellido'              => 'lastname',
            'correo'                => 'email',
            'rut'                   => 'rut',
            'telefono'              => 'telephone',
            'salt'                  => 'salt',
            'nacimiento'            => 'nacimiento',
            'address_id'            => 'address_id',
            'ip'                    => 'ip',
            'newsletter'            => 'newsletter',
            'status'                => 'status',
            'approved'              => 'approved', 
            'esVerificado'          => 'verified',
            'esAdministrador'       => 'admin',
            'timestamp'             => 'timestamp',
            'fechaCreacion'         => 'created_at',
            'fechaActualizacion'    => 'updated_at',
            'fechaEliminacion'      => 'deleted_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function transformedAttribute($index)
    {
        


        $attributes = [
            'id'                =>'identificador',
            'customer_group_id' =>'grupo_cliente_id',
            'invitado'          => 'invitado',
            'firstname'         =>'nombre',
            'lastname'          =>'apellido',
            'email'             =>'correo',
            'rut'               =>'rut',
            'telephone'         =>'telefono',
            'salt'              =>'salt',
            'nacimiento'        =>'nacimiento',
            'address_id'        =>'address_id',
            'ip'                =>'ip',
            'newsletter'        =>'newsletter',
            'status'            =>'status',
            'approved'          =>'approved',
            'verified'          =>'esVerificado',
            'admin'             =>'esAdministrador',
            'timestamp'         =>'timestamp',
            'created_at'        =>'fechaCreacion',
            'updated_at'        =>'fechaActualizacion',
            'deleted_at'        =>'fechaEliminacion',
        ];



        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
    
}
