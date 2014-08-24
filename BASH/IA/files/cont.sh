
#
# POR : Leonardo Bravo
# WEB : http://www.leobravo.cl
# FECHA : 24/09/2014
#
#	CONTADOR DE CLASES (RESPUESTA DE LAS PREGUNTAS 1 Y 2)
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
	file=$(echo $dir | rev | cut -d'.' -f2 | rev)
	person=$(cat $dir | sed 's/ /\n/g' | grep "/PERSON" | wc | awk {'print $1'})
	location=$(cat $dir | sed 's/ /\n/g' | grep "/LOCATION" | wc | awk {'print $1'})
	organization=$(cat $dir | sed 's/ /\n/g' | grep "/ORGANIZATION" | wc | awk {'print $1'})
	palabras=$(cat $dir | sed 's/ /\n/g' | wc | awk {'print $1'})
	let token=palabras-person-location-organization
	cd ..
	echo "#########################################">>log.txt
	echo "FILE :"$dir " / " $line >> log.txt
	echo "#########################################">>log.txt
	echo "PERSON :"$person >> log.txt
	echo "LOCATION :"$location >>log.txt
	echo "ORGANIZATION :"$organization>>log.txt
	echo "TOKEN :"$token>>log.txt
	let total_person=total_person+person
	let total_location=total_location+location
	let total_organization=total_organization+organization
	let total_token=total_token+token
	echo -e "\n">>log.txt
done < dir.tmp
rm -r dir.tmp

echo "---------">> log.txt
echo "TOTALES:">>log.txt
echo "---------" >> log.txt
echo "TOTAL PERSON: "$total_person >> log.txt
echo "TOTAL LOCATION: "$total_location>>log.txt
echo "TOTAL ORGANIZATION :"$total_organization>>log.txt
echo "TOTAL TOKEN :"$total_token>>log.txt
