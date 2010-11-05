# set the arbitrary application name
set :application, "ombi60.com"
# set the reposiotry url 
set :repository, "git-ombi@pl3.projectlocker.com:ombi60_on_git.git"

# Only deploy the master branch
set :branch, "master"
# Use git to deploy. You can also set this to 'svn'
set :scm, :git
# Keep Git quiet
set :scm_verbose, false

# set server user account responsible
set :user, "deploy"

## Deploy Settings
# Deploy via a remote repository cache. In git's case, it 
# does a "git fetch" on the remote cache before moving it into place
# can change this to :copy but apparently :remote_cache is faster
set :deploy_via, :remote_cache
# Do NOT use sudo by default. Helps with file permissions. You can still
# manually sudo by prepending #{sudo} to run commands
set :use_sudo, false

## SSH Options

# SSH Agent forwarding, sends my personal keys for usage by git when deploying.
ssh_options[:forward_agent] = true

ssh_options[:keys] = %w( /home/kei/Dropbox/amazon\ aws/ombi60_key.pem )


# setting for production environment
task :production do
  # If you aren't deploying to /u/apps/#{application} on the target
  # servers (which is the default), you can specify the actual location
  # via the :deploy_to variable:
  set :deploy_to, "/var/www/ombi60.com"
end


# setting for production environment
task :staging do
  # If you aren't deploying to /u/apps/#{application} on the target
  # servers (which is the default), you can specify the actual location
  # via the :deploy_to variable:
  set :deploy_to, "/var/www/ombi60.biz"
  set :config_files_folder, "staging"
  after("deploy:restart", :copy_config_files)
  after("deploy:restart", :restore_staging_database)
  after("deploy:restart", "alter_config:no_debug")
  after("deploy:restart", "alter_config:allow_none")
  
end

# more applicable for rails app
# for increasing load
role :app, "ombi60.biz"
role :web, "ombi60.biz"
role :db,  "ombi60.biz", :primary => true


#Deployment tasks
namespace :deploy do
  desc "Override the original :restart"
  task :restart, :roles => :app do
    clear_cache
  end

  desc "Override the original :migrate"
  task :migrate do
  end

end


namespace :clear_cache do
  desc <<-DESC
    Blow up all the cache files CakePHP uses, ensuring a clean restart.
  DESC
  task :default do
    # Remove absolutely everything from TMP
    run "rm -rf #{current_path}/app/tmp/*"
 
    # Create TMP folders
    run "mkdir -p #{current_path}/app/tmp/cache"
    run "mkdir -p #{current_path}/app/tmp/cache/models"
    run "mkdir -p #{current_path}/app/tmp/cache/persistent"
    run "mkdir -p #{current_path}/app/tmp/cache/views"
    
    run "mkdir -p #{current_path}/app/tmp/sessions"
    run "mkdir -p #{current_path}/app/tmp/logs"
    run "mkdir -p #{current_path}/app/tmp/tests"
    
    
    # set the permissions
    run "chmod 775 -R #{current_path}/app/tmp"
    
  end
end

namespace :restore_staging_database do
  task :default do
    run "cp /home/deploy/#{config_files_folder}/restore_staging_database #{current_path}/docs/database/"
    run ". #{current_path}/docs/database/restore_staging_database"
  end
end

namespace :copy_config_files do
  desc <<-DESC
    config files for staging is copied
  DESC
  task :default do
    run "cp /home/deploy/#{config_files_folder}/database.php #{current_path}/app/config/"
    run "cp /home/deploy/#{config_files_folder}/bootstrap.local.php #{current_path}/app/config/"
  end
end

namespace :alter_config do
  task :no_debug do
    run ". #{current_path}/app/config/no_debug"
  end
  task :full_debug do
    run ". #{current_path}/app/config/full_debug"
  end
  task :allow_all do
    run ". #{current_path}/app/config/allow_all"
  end
  task :allow_none do
    run ". #{current_path}/app/config/allow_none"
  end
end
