#! /bin/bash
    if [ -z $1 ]; 
        then 
            echo "Indique mensaje para usar como argumento"; 
         else 
            echo "Subiendo copia a github (pacDesarrolloServidor.git). Mensaje" $1;
			git init
			git add -A
			git commit  -m $1
			git branch -M main
			git remote set-url origin https://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@github.com/SamhainV/pacDesarrolloServidor2.git
			git push -u origin main
		fi