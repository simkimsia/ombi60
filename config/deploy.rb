# Only deploy the master branch
set :branch, "master"
# Use git to deploy. You can also set this to 'svn'
set :scm, :git
# Keep Git quiet
set :scm_verbose, false

## Deploy Settings
# Deploy via a remote repository cache. In git's case, it 
# does a "git fetch" on the remote cache before moving it into place
# can change this to :copy but apparently :remote_cache is faster
set :deploy_via, :remote_cache
# Do NOT use sudo by default. Helps with file permissions. You can still
# manually sudo by prepending #{sudo} to run commands
set :use_sudo, false

## SSH Options
# Deploy as this username the user in the server that is responsible for deployment
ssh_options[:username] = 'ubuntu'
# SSH Agent forwarding, sends my personal keys for usage by git when deploying.
ssh_options[:forward_agent] = true


# setting for production environment
task :production do
  set :application, "ombi60.com"
  set :repository, "git-ombi@pl3.projectlocker.com:ombi60_on_git.git"
  
end


# setting for production environment
task :staging do
  set :application, "ombi60.biz"
  set :repository, "git-ombi@pl3.projectlocker.com:ombi60_on_git.git"
  after('restore_staging_database')
end


# If you aren't deploying to /u/apps/#{application} on the target
# servers (which is the default), you can specify the actual location
# via the :deploy_to variable:
set :deploy_to, "/var/www/#{application}"


# more applicable for rails app
# for increasing load
role :app, "ombi60.com"
role :web, "ombi60.com"
role :db,  "ombi60.com", :primary => true


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
  desc "Blow up all the cache files CakePHP uses, ensuring a clean restart."
  task :default do
    # Remove ONLY files from TMP but leave the folders alone.
    run "rm -f #{shared_path}/app/tmp/*"
    
    # Remove ONLY files from TMP/cache but leave the folders alone.
    run "rm -f #{shared_path}/app/tmp/cache/*"
    
    # Remove ONLY files from TMP/cache/models, TMP/cache/views, TMP/cache/persistent, but leave the folders alone.
    run "rm -f #{shared_path}/app/tmp/cache/{models/*,views/*,persistent/*}"
    
    # Remove ONLY files from TMP/cache/models, TMP/cache/views, TMP/cache/persistent, but leave the folders alone.
    run "rm -f #{shared_path}/app/tmp/{sessions,tests}"

  end
end

namespace :restore_staging_database do
  task :default do
    run " . #{shared_path}/restore_staging_database"
  end
end
