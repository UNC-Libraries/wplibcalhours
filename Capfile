# Load DSL and set up stages
require 'capistrano/setup'

# Include default deployment tasks
require 'capistrano/deploy'
require 'capistrano/scm/git'

# Use SFTP instead of SCP to accommodate RHEL9 changes
SSHKit::Backend::Netssh.configure do |ssh|
  ssh.transfer_method = :sftp
end

install_plugin Capistrano::SCM::Git
