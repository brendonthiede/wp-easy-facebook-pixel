# wp-easy-facebook-pixel

WordPress plugin for adding a Facebook Pixel to your site

## Usage

Add this plugin to your site and provide a Pixel ID to add ViewContent events to every page of your site.
You can customize the events associated with each page by editing them individually.

## Development

### Starting Environment

With Docker installed, cd into this directory and run:

```bash
docker-compose up -d
```

### Stopping Environment

With Docker installed, cd into this directory and run:

```bash
docker-compose down
```

### Enabling Worpress Debugging

Run the following command:

```bash
docker exec -it wp-easy-facebook-pixel_wordpress_1 sed -i "s/define( 'WP_DEBUG', false );/define( 'WP_DEBUG', true );/" /var/www/html/wp-config.php
```

### Disabling Worpress Debugging

Run the following command:

```bash
docker exec -it wp-easy-facebook-pixel_wordpress_1 sed -i "s/define( 'WP_DEBUG', true );/define( 'WP_DEBUG', false );/" /var/www/html/wp-config.php
```
