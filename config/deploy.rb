set :application, 'unc-wplibcalhours'
set :repo_url, 'https://github.com/UNC-Libraries/wplibcalhours.git'

set :deploy_to, "/net/deploy/#{fetch(:stage)}/#{fetch(:application)}"

set :format, :pretty
set :log_level, :info
set :pty, true

set :keep_releases, 5


namespace :deploy do
  desc 'Symlink application'
  task :symlink_htdocs do
    on roles(:app) do |h|
      info 'Symlinking app into htdocs'

      execute :ln, '-nfs', "#{current_path}", "#{fetch(:htdocs_path)}/unc-wplibcalhours"
    end
  end
end

after 'deploy:finishing', 'deploy:cleanup'
after 'deploy:finished', 'deploy:symlink_htdocs'
