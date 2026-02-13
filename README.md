docker build -t registry.sme.prefeitura.sp.gov.br/wordpress/base:7.4.33-apache-bullseye -f Dockerfile.php7 .

docker build -t registry.sme.prefeitura.sp.gov.br/wordpress/homolog/ceu .

docker push registry.sme.prefeitura.sp.gov.br/wordpress/base:7.4.33-apache-bullseye

docker push registry.sme.prefeitura.sp.gov.br/wordpress/homolog/ceu

docker login registry.sme.prefeitura.sp.gov.br

- wordpress / (solicitar acesso a equipe)
- acesso somente leitura