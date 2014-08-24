#
# POR : Leonardo Bravo
# WEB : http://www.leobravo.cl
# FECHA : 24/09/2014
#
#	CONTADOR DE CLASES SUGERIDAS (RESPUESTA DE LAS PREGUNTAS 3 Y 4)
#   -----------------------------------------------------
#
#	- CUENTA LAS CLASES DE LAS 26 CATEGORIAS
#	- CUENTA LAS CALSES DE C/U DE LAS CATEGORIAS
#

ls -l | awk {'print $1  $9'} | grep drwxr | sed 's/-x/ /g' | awk {'print $3'} > dir.tmp
total_person=0
total_location=0
total_organization=0
total_token=0
while read line
do
	person=0
	location=0
	organization=0
	token=0
	echo $line
	cd $line
	pos=$(pwd)
	echo "->Analizando " $pos
	dir=$(ls -l | awk {'print $9'} | grep .bz2 | sed 's/.bz2//g')
	file=$(echo $dir"_ori" | rev | cut -d'.' -f2 | rev)
	person=$(cat $dir"_ori" | sed 's/ /\n/g' | grep "/PERSON" | wc | awk {'print $1'})
	location=$(cat $dir"_ori" | sed 's/ /\n/g' | grep "/LOCATION" | wc | awk {'print $1'})
	organization=$(cat $dir"_ori" | sed 's/ /\n/g' | grep "/ORGANIZATION" | wc | awk {'print $1'})
	palabras=$(cat $dir"_ori" | sed 's/ /\n/g' | wc | awk {'print $1'})
	let token=palabras-person-location-organization
	cd ..
	echo "#########################################">>log_sugeridas.txt
	echo "FILE :"$dir " / " $line >> log_sugeridas.txt
	echo "#########################################">>log_sugeridas.txt
	echo "PERSON :"$person >> log_sugeridas.txt
	echo "LOCATION :"$location >>log_sugeridas.txt
	echo "ORGANIZATION :"$organization>>log_sugeridas.txt
	echo "TOKEN :"$token>>log_sugeridas.txt
	let total_person=total_person+person
	let total_location=total_location+location
	let total_organization=total_organization+organization
	let total_token=total_token+token
	echo -e "\n">>log_sugeridas.txt
done < dir.tmp
rm -r dir.tmp

echo "---------">> log_sugeridas.txt
echo "TOTALES:">>log_sugeridas.txt
echo "---------" >> log_sugeridas.txt
echo "TOTAL PERSON: "$total_person >> log_sugeridas.txt
echo "TOTAL LOCATION: "$total_location>>log_sugeridas.txt
echo "TOTAL ORGANIZATION :"$total_organization>>log_sugeridas.txt
echo "TOTAL TOKEN :"$total_token>>log_sugeridas.txt
