set :stage, :prod
set :branch, 'main'
set :htdocs_path, '/htdocs/redesign/wp-content/plugins'

server 'redesign.lib.unc.edu', user: 'swallow', roles: [:app], group: 'webadmin'