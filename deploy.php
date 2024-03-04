<?php

namespace Deployer;

require_once 'recipe/typo3.php';
require_once 'contrib/rsync.php';

set('typo3_webroot', 'public');
set('current_path', '{{deploy_path}}/releases/current');
set('keep_releases', 5);
set('bin/composer', '{{bin/php}} /usr/bin/composer');

set('release_name', static function (): string {
    return date('Y-m-d-His_') . getenv('COMMIT_HASH');
});

set('rsync', [
    'exclude' => [
        '.Build',
        '.git*',
        '.ddev',
        '.deployer',
        '.idea',
        '.DS_Store',
        '.npm',
        '.editorconfig',
        '.env',
        '.php-cs-fixer*.php',
        '.phpstan.neon',
        'auth.json',
        'deploy.php',
        'package.json',
        'package-lock.json',
        'webpack.config.js',
        'node_modules/',
        'var/',
    ],
    'exclude-file' => false,
    'include' => [
        'packages/site_distribution/Resources/Public',
    ],
    'include-file' => false,
    'filter' => [],
    'filter-file' => false,
    'filter-perdir' => false,
    'flags' => 'rz',
    'options' => [
        'delete',
        'keep-dirlinks',
        'links',
    ],
    'timeout' => 600,
]);

// Symlink folders to shared/* (persistent data)
set('shared_dirs', [
    '{{typo3_webroot}}/fileadmin',
]);

// Symlink files to shared/
set('shared_files', []);

set('writable_mode', 'chmod');
set('writable_recursive', true);
set('writable_dirs', [
    '{{deploy_path}}/shared/{{typo3_webroot}}',
]);

host('develop')
    ->set('hostname', getenv('DEPLOYMENT_SERVER_HOST'))
    ->set('port', getenv('DEPLOYMENT_SERVER_PORT'))
    ->set('remote_user', getenv('DEPLOYMENT_SERVER_REMOTE_USER'))
    ->set('deploy_path', getenv('DEPLOYMENT_SERVER_DEPLOY_PATH'))
    ->set('rsync_src', './')
    ->set('ssh_multiplexing', false)
    ->set('php_version', getenv('PHP_VERSION'));

host('staging')
    ->set('hostname', getenv('DEPLOYMENT_SERVER_HOST'))
    ->set('port', getenv('DEPLOYMENT_SERVER_PORT'))
    ->set('remote_user', getenv('DEPLOYMENT_SERVER_REMOTE_USER'))
    ->set('deploy_path', getenv('DEPLOYMENT_SERVER_DEPLOY_PATH'))
    ->set('rsync_src', './')
    ->set('ssh_multiplexing', false)
    ->set('php_version', getenv('PHP_VERSION'));

host('production')
    ->set('hostname', getenv('DEPLOYMENT_SERVER_HOST'))
    ->set('port', getenv('DEPLOYMENT_SERVER_PORT'))
    ->set('remote_user', getenv('DEPLOYMENT_SERVER_REMOTE_USER'))
    ->set('deploy_path', getenv('DEPLOYMENT_SERVER_DEPLOY_PATH'))
    ->set('rsync_src', './')
    ->set('ssh_multiplexing', false)
    ->set('php_version', getenv('PHP_VERSION'));

task('typo3:extension:setup', static function (): void {
    run("cd {{release_path}} && {{bin/php}} vendor/bin/typo3 extension:setup");
});

task('typo3:cache:flush', static function (): void {
    run("cd {{release_path}} && {{bin/php}} vendor/bin/typo3 cache:flush");
});

task('typo3:cache:warmup', static function (): void {
    run("cd {{release_path}} && {{bin/php}} vendor/bin/typo3 cache:warmup");
});

task('deploy:symlink', static function (): void {
    run("cd {{deploy_path}} && {{bin/symlink}} {{release_path}}/{{typo3_webroot}} {{current_path}}");
    run("cd {{deploy_path}} && rm release");
});

task('deploy:prepare', []);
task('deploy', [
    'deploy:info',
    'deploy:setup',
    'deploy:lock',
    'deploy:release',
    'deploy:writable',
    'rsync',
    'deploy:shared',
    'deploy:symlink',
    'typo3:extension:setup',
    'typo3:cache:flush',
    'typo3:cache:warmup',
    'deploy:unlock',
    'deploy:cleanup',
    'deploy:success',
]);

after('deploy:failed', 'deploy:unlock');
after('deploy:failed', 'deploy:cleanup');
