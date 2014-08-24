#
# POR : Leonardo Bravo
# WEB : http://www.leobravo.cl
# FECHA : 24/09/2014
#
#	CONTADOR DE CLASES PALABRAS SUGERIDAS ERRONEAS (RESPUESTA DE LAS PREGUNTAS 3 Y 4)
#   -----------------------------------------------------
#
#	- CUENTA LAS CLASES DE LAS 26 CATEGORIAS
#	- CUENTA LAS CALSES DE C/U DE LAS CATEGORIAS
#

substr() {
	aux=$(echo "$1" | awk '{split($0,a,"'$2'"); print a[2]}')
	echo "$aux" | awk '{split($0,a,"'$3'"); print a[1]}'
	rm -f .out
}

ls -l | awk {'print $1  $9'} | grep drwxr | sed 's/-x/ /g' | awk {'print $3'} > dir.tmp

while read dir
do
	echo $dir
	cd $dir
        kk=$(ls -l | awk {'print $9'} | grep .bz2 | sed 's/.bz2//g')
        file=$(echo $kk | rev | cut -d'.' -f2 | rev)
	echo "FILE --"$file
	#1) una palabra por linea (solo )
	sug=$(cat $file"_ori" | sed 's/ /\n'/g | grep "suggestions")
	#2) buscar palabras sugeridas
	substr "$sug" "<suggestions>" "</suggestions>" > sugerencias.tmp
	cat sugerencias.tmp | sed 's/ /\n/g' | grep / > sugerencias.txt
	rm -rfv sugerencias.tmp
	#3) contar la procedencia.
	total_sugerencias=$(wc sugerencias.txt | awk {'print $1'})
	total_personas=$(cat sugerencias.txt | grep "/PERSON" > tmp && wc tmp | awk {'print $1'})
	rm -rfv tmp
	total_location=$(cat sugerencias.txt | grep "/LOCATION" > tmp && wc tmp | awk {'print $1'})
	rm -rfv tmp
	total_organization=$(cat sugerencias.txt | grep "/ORGANIZATION" > tmp && wc tmp | awk {'print $1'})
	rm -rfv tmp
	#4) texto manual buscar la palabra
	person_error=0
	location_error=0
	organization_error=0
	while read line
	do
		search=$(cat $file | grep $line | wc | awk {'print $1'})
		if [ $search = 0 ]; then
			echo "ERROR EN :"$line >> log_diff.txt
			person_e=$(echo $line | grep "/PERSON" | wc | awk {'print $1'})
			location_e=$(echo $line | grep "/LOCATION" | wc | awk {'print $1'})
			organization_e=$(echo $line | grep "/ORGANIZATION" | wc | awk {'print $1'})

		        if [ $person_e = 1 ]; then
				let person_error=person_error+1
			fi
		        if [ $location_e = 1 ]; then
				let location_error=location_error+1
			fi
		        if [ $organization_e = 1 ]; then
				let organization_error=organization_error+1
			fi
		fi
	done < sugerencias.txt
	rm -rfv sugerencias.txt
	#5) validar si tiene el tag
	cd ..
	echo -e "\n">>log_diff.txt
	echo "ERRORES :"$file" / "$dir>>log_diff.txt
	echo "-------">>log_diff.txt
	echo -e "\n">>log_diff.txt
	echo "TOTAL SUGERENCIAS :"$total_sugerencias >> log_diff.txt
	echo "TOTAL PERSON :"$total_personas >>log_diff.txt
	echo "TOTAL LOCATION :"$total_location>>log_diff.txt
	echo "TOTAL ORGANIZATION :"$total_organization>>log_diff.txt
	echo -e "\n">>log_diff.txt
	echo "ERRORES PERSON :" $person_error>>log_diff.txt
	echo "ERRORES LOCATION :" $location_error>>log_diff.txt
	echo "ERRORES ORGANIZATION :" $organization_error>>log_diff.txt

done < dir.tmp
rm -rfv dir.tmp
