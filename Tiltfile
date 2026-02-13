docker_compose('docker-compose.yml')
docker_build('wordpress/ceu', '.',
  live_update = [
    sync('.', '/var/www/html')
  ])