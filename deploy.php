<?php
namespace Deployer;

require 'recipe/drupal8.php';

// Project name
set('application', 'my_project');

// Project repository
set('repository', 'git@github.com:rakeshf/drupal_gitpod.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server 
add('writable_dirs', []);


// Hosts

host('192.168.50.4')
    ->user('deployer')
    ->set('deploy_path', '/var/www/html');    
    
// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

desc('Clear cache');
task('deploy:shared:install', function() {
    run('cd {{release_path}} && composer install');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

