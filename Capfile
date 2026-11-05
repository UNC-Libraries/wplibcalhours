# Load DSL and set up stages
require 'capistrano/setup'

# Include default deployment tasks
require 'capistrano/deploy'
require 'capistrano/scm/git'

install_plugin Capistrano::SCM::Git

SSHKit::Backend::Netssh.configure do |ssh|
  ssh.transfer_method = :sftp
end
