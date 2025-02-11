#!/bin/bash

COLOR='\033[0;36m'
SUCCESS_COLOR='\033[0;32m'
ERROR_COLOR='\033[0;31m'
NOCOLOR='\033[0m'

printf "${COLOR}> Minificando CSS...${NOCOLOR}\n"

cd views/css/src || {
  printf "${ERROR_COLOR}Erro: Falha ao acessar o diretório views/css/src.${NOCOLOR}\n"
  exit 1
}

for file in *.css; do
  ../../../node_modules/minify/bin/minify.js $file > "${file%.*}".min.css 2>/dev/null
  if [ $? -ne 0 ]; then
    printf "${ERROR_COLOR}Erro ao minificar o arquivo $file.${NOCOLOR}\n"
    exit 1
  fi
done

mv *.min.css ../dist || {
  printf "${ERROR_COLOR}Erro ao mover os arquivos minificados para views/css/dist.${NOCOLOR}\n"
  exit 1
}

cd ../../.. || exit 1

printf "${SUCCESS_COLOR}> CSS minificado com sucesso!${NOCOLOR}\n"

printf "${COLOR}> Minificando JavaScript...${NOCOLOR}\n"

cd views/javascript/src || {
  printf "${ERROR_COLOR}Erro: Falha ao acessar o diretório views/javascript/src.${NOCOLOR}\n"
  exit 1
}

for file in *.js; do
  ../../../node_modules/minify/bin/minify.js $file > "${file%.*}".min.js 2>/dev/null
  if [ $? -ne 0 ]; then
    printf "${ERROR_COLOR}Erro ao minificar o arquivo $file.${NOCOLOR}\n"
    exit 1
  fi
done

mv *.min.js ../dist || {
  printf "${ERROR_COLOR}Erro ao mover os arquivos minificados para views/javascript/dist.${NOCOLOR}\n"
  exit 1
}

cd ../../.. || exit 1

printf "${SUCCESS_COLOR}> JavaScript minificado com sucesso!${NOCOLOR}\n"
printf "${COLOR}> Minify OK!${NOCOLOR}\n"
