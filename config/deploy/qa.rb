set :stage, :qa
set :branch, 'main'
set :htdocs_path, '/htdocs/www-dev/wp-content/plugins'

server 'napoli.lib.unc.edu', user: 'swallow', roles: [:app], group: 'webadmin'
