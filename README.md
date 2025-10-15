# bcs-boost

## AWS

### EC2 Instance Creation

When first setting up the AWS EC2 webserver instance, upload the `scripts/aws-user-data.sh` as the "User Data" for the 
instance

After the instance has been created, ssh into the instance and modify the `.env` file in the `/var/www/html` directory 
with the database url and password, the mailing password, and any other configurations desired.

After doing so, you must call the following to update the cache optimizations and restart the apache service:
```bash
cd /var/www/html
php artisan optimize:clear
php artisan optimize
sudo systemctl restart apache2
```

If everything is working, you can now create an Amazon Machine Image (AMI) from this instance and use that to spin up 
future instances.
