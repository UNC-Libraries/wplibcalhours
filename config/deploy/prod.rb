set :stage, :prod
set :branch, 'main'
set :htdocs_path, '/htdocs/library/wp-content/plugins'

server 'library.unc.edu', user: 'swallow', roles: [:app], group: 'webadmin'