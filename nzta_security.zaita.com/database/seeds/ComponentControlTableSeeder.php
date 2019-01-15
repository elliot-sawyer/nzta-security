<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComponentControlTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      /**
       * Multi-Factor Authentication
       */
      $this->insert('Microsoft Authenticator', 'All logins use Microsoft Authenticator');
      $this->insert('Google Authenticator', 'All logins use Microsoft Google');
      $this->insert('SMS/Txt Message', 'Text messages provide random number');
      
      
      /**
       * Insert Containers
       */
      $components = array('Google Kubernetes Engine',
        'Amazon Elastic Container Service',
        'Amazon Elastic Container Service for Kubernetes',
        'Digital Ocean Droplet',
        'Azure Kubernetes Service (AKS)',
      );
      foreach ($components as $component) {
        $this->insert($component, 'Deployment is automated using CI/CD (Jenkins)');
        $this->insert($component, 'User Access to Production Container is restricted');
        $this->insert($component, 'Network Access to Production Container is restricted');
        $this->insert($component, 'Component security updates have been implemented');
      }

      
      /**
       * Insert Compute Platforms
       */
      $components = array('Google Compute Engine',
        'Amazon EC2',
        'Azure Virtual Machines'
      );
      foreach ($components as $component) {
        $this->insert($component, 'Deployment is automated using CI/CD (Jenkins)');
        $this->insert($component, 'User Access to Production Container is restricted');
        $this->insert($component, 'Network Access to Production Container is restricted');
        $this->insert($component, 'Component security updates have been implemented');
        $this->insert($component, 'Operating System updates have a managed process');
        $this->insert($component, 'Operating System is on Transport Agency approved list');
        $this->insert($component, 'FTP server has been disabled');
        $this->insert($component, 'Anti-Virus has been installed');
        $this->insert($component, 'Anti-Malware has been installed');
        $this->insert($component, 'Operating System is integrated with Active Directory');        
      }      
    } 
    
    public function insert($component, $control) {
      $component_id = DB::table('component')->where('name', $component)->first()->id;
      
      DB::table('component_control')->insert(['component_id' => $component_id, 'name' => $control, 'description' => 'sample description']);      
    }
    
}

