<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComponentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      /**
       * Insert Multi-Factor Authentication components
       * @var array $components
       */
      $components = array('Microsoft Authenticator', 'Google Authenticator', 'SMS/Txt Message');
      $this->insert('Multi-Factor Authentication', $components);
      
      /**
       * Insert Container (Docker, K8s etc)
       */
      $components = array('Google Kubernetes Engine',        
        'Amazon Elastic Container Service',
        'Amazon Elastic Container Service for Kubernetes',
        'Digital Ocean Droplet',
        'Azure Kubernetes Service (AKS)', 
      );
      $this->insert('Container', $components);
      
      /**
       * Insert Compute Platforms
       */
      $components = array('Google Compute Engine',
        'Amazon EC2',
        'Azure Virtual Machines'
      );
      $this->insert('Compute', $components);
      
    }
    
    public function insert(string $type, array $components) {
      
      foreach($components as $component) {
        DB::table('component')->insert([
          'type' => $type,
          'name' => $component
        ]);
      }
    }
}
