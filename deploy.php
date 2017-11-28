<?php
namespace Deployer;

require 'recipe/common.php';

// Project name
set('application', 'arcelik');

// Project repository
set('repository', 'git@github.com:mehmetdilber/site.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
set('shared_files', [
    "config.php",
    "admin/config.php"
]);
set('shared_dirs', []);

// Writable dirs by web server 
set('writable_dirs', [
    "system/cache",
    "system/logs"
]);


// Hosts

host('139.59.138.107')
    ->set('deploy_path', '/var/www/html')
    ->user('root')
;
    

// Tasks

desc('Deploy your project');
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
   # 'deploy:vendors',
    'deploy:clear_paths',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'success'
]);

// [Optional] If deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
