<?php

namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', env('APP_NAME'));
// Project repository
set('repository', 'https://github.com/kakitsubun/hanagacha.git');
// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', false);
// Default stage develop
set('default_stage', 'develop');

set('writable_mode', 'chmod');

// Shared files/dirs between deploys 
add('shared_files', [
    '.env',
]);
add('shared_dirs', [
    'storage',
    'credentials',
]);
// Writable dirs by web server
add('writable_dirs', [
    'storage',
    'bootstrap/cache',
]);

// Hosts
inventory('host.yml')
    ->stage('develop')
    ->set('deploy_path', '/var/www/html/web');

// Task
task('test_task', function() {
    write('Deployer Test');
});
task('update_task:yarn', function () {
    run('yarn install');
});
task('update_task:npm', function () {
    $stage = get('stage');
    if ($stage == 'develop') {
        run('npm run dev');
    } else {
        run('npm run dev');
    }
});
task('update_task:storage_link', function () {
    run('php artisan storage:link');
});
task('update_task', [
    'update_task:yarn',
    'update_task:npm',
    'update_task:storage_link',
]);

task('migrate_task:force', function () {
    run('php artisan migrate --force');
});
task('migrate_task:statistics', function () {
    run('php artisan migrate --database="mysql_statistics"');
});
task('migrate_task', [
    'migrate_task:force',
//    'migrate_task:statistics',
]);

task('restart', function () {
    run('sudo service php7.2-fpm restart');
//    run('sudo service supervisor restart');
});

task('copy:shared', function () {
    $path = get('deploy_path','/var/www/html/web');
    $shared_path = "${path}/../shared";
    run("cp -R ${shared_path} {{deploy_path}}/");
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release. Customized
//before('deploy:shared', 'copy:shared');

// Migrate database before symlink new release. Customized
//after('deploy:symlink', 'migrate_task');

// Yarn + NPM + LINK
after('deploy:shared', 'update_task');

// Restart
after('cleanup', 'restart');
after('restart', 'artisan:queue:restart');

desc('Deploy your project');
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:vendors',
    'deploy:writable',
    'artisan:storage:link',
    'artisan:view:clear',
    'artisan:config:cache',
    'artisan:optimize',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
]);

after('deploy', 'success');
