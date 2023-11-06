set :stage, :sandbox
set :branch, 'main'
set :htdocs_path, '/htdocs/www-test/wp-content/plugins'

server 'napoli.lib.unc.edu', user: 'swallow', roles: [:app], group: 'webadmin'