.PHONY: grav-build-local
grav-build-local:
	ansible-playbook grav-build.yml -i inventories/local.yml -e "tag=main"

.PHONY: grav-deploy-local
grav-deploy-local:
	ansible-playbook grav-deploy.yml -i inventories/local.yml -e "tag=main"

.PHONY: grav-backup-local
grav-backup-local:
	ansible-playbook grav-backup.yml -i inventories/local.yml