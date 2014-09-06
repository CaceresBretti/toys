substr() {
	aux=$(echo "$1" | awk '{split($0,a,"'$2'"); print a[2]}')
	echo "$aux" | awk '{split($0,a,"'$3'"); print a[1]}'
	rm -f .out
}


progreso() {
	percent=`awk 'BEGIN{printf("%0.2f", '$1' / '$2' * 100)}'`
	MESSAGE=$3
	let COLUMNA=$(tput cols)-$(echo $MESSAGE | wc -m)-2
	echo -en "\r";
	echo -en "$MESSAGE $EXT $percent %: "
	let barra=$1*$COLUMNA; let barra=$barra/$2;let barra2=$COLUMNA-$barra;
	if [ $barra -eq $COLUMNA ];then
		for j in `seq 1 $barra`;do
			echo -en "\033[44m ";
		done
	else
	for j in `seq 1 $barra`;do
		echo -en "\033[41m ";
	done
	for k in `seq 1 $barra2`;do
		echo -en "\033[47m ";
	done
	fi
	echo -en "||\033[40m"
}


sqlite_tables(){
	echo "Creando Tablas"
	sqlite3 ia.db "create table palabras (string text, pos text, tema text)"
	sqlite3 ia.db "create table frecuencia (id integer primary key not null, palabra text, frecuencia integer)"
	sqlite3 ia.db "create table vector_palabra (id integer primary key not null, clase text, izq1 text, izq2 text, izq3 text, palabra text, der1 text, der2 text, der3 text, tema text)"
}


sqlite_insert_palabra(){
	sqlite3 ../ia.db "insert into palabras (string, pos, tema) values ('$1', '$2', '$3')"
}

sqlite_insert_vector_palabra(){
	sqlite3 ../ia.db "insert into vector_palabra (clase, izq1, izq2, izq3, palabra, der1, der2, der3, tema) values ($1, '$2', '$3', '$4', '$5', '$6', '$7', '$8', '$9')"
}

sqlite_insert_frecuencia(){
        sqlite3 ia.db "insert into frecuencia (palabra, frecuencia) select string, count(*) from palabras group by string;"
}

#CREO LAS TABLAS
sqlite_tables

ls -l | awk {'print $1  $9'} | grep drwxr | sed 's/-x/ /g' | awk {'print $3'} > dir.tmp
total_dir=$(wc dir.tmp | awk {'print $1'})
cont_dir=1
while read carpeta
do
	cd $carpeta
	archivo=$(ls -l | awk {'print $9'} | grep .bz2 | sed 's/.bz2//g')
	#CREANDO TABLAS
	tema="$archivo"
	cat $archivo | sed 's/ /\n/g' | sed 's/question//g' | sed 's/>//g' | sed 's/<//g' | sed 's/suggestions//g' | sed 's/answer//g' | sed 's/\\//g' | sed 's/!//g' | sed 's/;//g'> vector_bruto.tmp
	sed '/./!d' vector_bruto.tmp > vector.tmp
	rm -rfv vector_bruto.tmp
	max_line=$(wc vector.tmp | awk {'print $1'})
	num_line=0
	while read line
	do
		#BARRA DE PROGRESO
		clear
		echo "Generando Mapa Plabras Izquierda/Palabra/Derecha"
		echo "PROCESANDO "$cont_dir" / "$total_dir
		progreso $num_line $max_line "$carpeta"

		#PERSON
		class_person=$(echo $line |grep PERSON | wc | awk {'print $1'})
		if [ $class_person -ge 1 ]; then
			echo ">>PERSON"
			class=2
			let izq1=num_line
			let izq2=num_line-1
			let izq3=num_line-2
			let der1=num_line+2
			let der2=num_line+3
			let der3=num_line+4
			#echo "izquierda_"$(sed -n $izq3'p' < vector.tmp)>> vector.txt
			s_izq1=$(sed -n $izq3'p' < vector.tmp)
			#echo "izquierda_"$(sed -n $izq2'p' < vector.tmp)>> vector.txt
			s_izq2=$(sed -n $izq2'p' < vector.tmp)
			#echo "izquierda_"$(sed -n $izq1'p' < vector.tmp)>> vector.txt
			s_izq3=$(sed -n $izq1'p' < vector.tmp)
			#echo "palabra_"$line>> vector.txt
			palabra=$line
			#echo "derecha_"$(sed -n $der1'p' < vector.tmp)>> vector.txt
			s_der1=$(sed -n $der1'p' < vector.tmp)
			#echo "derecha_"$(sed -n $der2'p' < vector.tmp)>> vector.txt
			s_der2=$(sed -n $der2'p' < vector.tmp)
			#echo "derecha_"$(sed -n $der3'p' < vector.tmp)>> vector.txt
			s_der3=$(sed -n $der3'p' < vector.tmp)
			#echo -e "\n">> vector.txt

			echo ">>INSERTANDO PALABRA"
			sqlite_insert_palabra $s_izq1 "izq" $tema
			sqlite_insert_palabra $s_izq2 "izq" $tema
			sqlite_insert_palabra $s_izq3 "izq" $tema

			sqlite_insert_palabra $palabra "pal" $tema

			sqlite_insert_palabra $s_der1 "der" $tema
			sqlite_insert_palabra $s_der2 "der" $tema
			sqlite_insert_palabra $s_der3 "der" $tema

			echo ">>INSERTANDO VECTOR_PALABRA"

			sqlite_insert_vector_palabra $class $s_izq1 $s_izq2 $s_izq3 $palabra $s_der1 $s_der2 $s_der3 $tema
		fi

		#LOCATION
		class_location=$(echo $line |grep LOCATION | wc | awk {'print $1'})
		if [ $class_location -ge 1 ]; then
			echo ">>LOCATION"
			class=3
			let izq1=num_line
			let izq2=num_line-1
			let izq3=num_line-2
			let der1=num_line+2
			let der2=num_line+3
			let der3=num_line+4
			#echo "izquierda_"$(sed -n $izq3'p' < vector.tmp)>> vector.txt
			s_izq1=$(sed -n $izq3'p' < vector.tmp)
			#echo "izquierda_"$(sed -n $izq2'p' < vector.tmp)>> vector.txt
			s_izq2=$(sed -n $izq2'p' < vector.tmp)
			#echo "izquierda_"$(sed -n $izq1'p' < vector.tmp)>> vector.txt
			s_izq3=$(sed -n $izq1'p' < vector.tmp)
			#echo "palabra_"$line>> vector.txt
			palabra=$line
			#echo "derecha_"$(sed -n $der1'p' < vector.tmp)>> vector.txt
			s_der1=$(sed -n $der1'p' < vector.tmp)
			#echo "derecha_"$(sed -n $der2'p' < vector.tmp)>> vector.txt
			s_der2=$(sed -n $der2'p' < vector.tmp)
			#echo "derecha_"$(sed -n $der3'p' < vector.tmp)>> vector.txt
			s_der3=$(sed -n $der3'p' < vector.tmp)
			#echo -e "\n">> vector.txt
			echo ">>INSERTANDO PALABRA"
			sqlite_insert_palabra $s_izq1 "izq" $tema
			sqlite_insert_palabra $s_izq2 "izq" $tema
			sqlite_insert_palabra $s_izq3 "izq" $tema

			sqlite_insert_palabra $palabra "pal" $tema

			sqlite_insert_palabra $s_der1 "der" $tema
			sqlite_insert_palabra $s_der2 "der" $tema
			sqlite_insert_palabra $s_der3 "der" $tema

			echo ">>INSERTANDO VECTOR_PALABRA"

			sqlite_insert_vector_palabra $class $s_izq1 $s_izq2 $s_izq3 $palabra $s_der1 $s_der2 $s_der3 $tema
		fi

		#ORGANIZATION
		class_organization=$(echo $line |grep ORGANIZATION | wc | awk {'print $1'})
		if [ $class_organization -ge 1 ]; then
			echo ">>ORGANIZATION"
			class=4
			let izq1=num_line
			let izq2=num_line-1
			let izq3=num_line-2
			let der1=num_line+2
			let der2=num_line+3
			let der3=num_line+4
			#echo "izquierda_"$(sed -n $izq3'p' < vector.tmp)>> vector.txt
			s_izq1=$(sed -n $izq3'p' < vector.tmp)
			#echo "izquierda_"$(sed -n $izq2'p' < vector.tmp)>> vector.txt
			s_izq2=$(sed -n $izq2'p' < vector.tmp)
			#echo "izquierda_"$(sed -n $izq1'p' < vector.tmp)>> vector.txt
			s_izq3=$(sed -n $izq1'p' < vector.tmp)
			#echo "palabra_"$line>> vector.txt
			palabra=$line
			#echo "derecha_"$(sed -n $der1'p' < vector.tmp)>> vector.txt
			s_der1=$(sed -n $der1'p' < vector.tmp)
			#echo "derecha_"$(sed -n $der2'p' < vector.tmp)>> vector.txt
			s_der2=$(sed -n $der2'p' < vector.tmp)
			#echo "derecha_"$(sed -n $der3'p' < vector.tmp)>> vector.txt
			s_der3=$(sed -n $der3'p' < vector.tmp)
			#echo -e "\n">> vector.txt
			echo ">>INSERTANDO PALABRA"
			sqlite_insert_palabra $s_izq1 "izq" $tema
			sqlite_insert_palabra $s_izq2 "izq" $tema
			sqlite_insert_palabra $s_izq3 "izq" $tema

			sqlite_insert_palabra $palabra "pal" $tema

			sqlite_insert_palabra $s_der1 "der" $tema
			sqlite_insert_palabra $s_der2 "der" $tema
			sqlite_insert_palabra $s_der3 "der" $tema

			echo ">>INSERTANDO VECTOR_PALABRA"

			sqlite_insert_vector_palabra $class $s_izq1 $s_izq2 $s_izq3 $palabra $s_der1 $s_der2 $s_der3 $tema
		fi


		let num_line=num_line+1
	done < vector.tmp
	rm -rfv vector.tmp
	cd ..
	let cont_dir=cont_dir+1
done < dir.tmp
rm -rfv dir.tmp

#CONTAR LA FRECUENCIA
clear
echo "Calculando la frecuencia...."
sqlite_insert_frecuencia
clear
echo "Calculando la frecuencia -Listo!"


#GENERAR VECTOR
sqlite3 ia.db "select * from vector_palabra;" >> vector_palabra.tmp
while read line
do
        v=0
        token=$(echo $line | awk -F '|' {'print $2'})
        s_izq1=$(echo $line | awk -F '|' {'print $3'})
        s_izq2=$(echo $line | awk -F '|' {'print $4'})
        s_izq3=$(echo $line | awk -F '|' {'print $5'})
        s_palabra=$(echo $line | awk -F '|' {'print $6'})
        s_der1=$(echo $line | awk -F '|' {'print $7'})
        s_der2=$(echo $line | awk -F '|' {'print $8'})
        s_der3=$(echo $line | awk -F '|' {'print $9'})
        comentario=$(echo $line | awk -F '|' {'print $10'})

        izq1=$(sqlite3 ia.db "select id, frecuencia from frecuencia where palabra='$s_izq1';" | sed 's/|/:/g')
        izq2=$(sqlite3 ia.db "select id, frecuencia from frecuencia where palabra='$s_izq2';" | sed 's/|/:/g')
        izq3=$(sqlite3 ia.db "select id, frecuencia from frecuencia where palabra='$s_izq3';" | sed 's/|/:/g')
        palabra=$(sqlite3 ia.db "select id, frecuencia from frecuencia where palabra='$s_palabra';" | sed 's/|/:/g')
        der1=$(sqlite3 ia.db "select id, frecuencia from frecuencia where palabra='$s_der1';" | sed 's/|/:/g')
        der2=$(sqlite3 ia.db "select id, frecuencia from frecuencia where palabra='$s_der2';" | sed 's/|/:/g')
        der3=$(sqlite3 ia.db "select id, frecuencia from frecuencia where palabra='$s_der3';" | sed 's/|/:/g')

        echo $token" "$izq1" "$izq2" "$izq3" "$palabra" "$der1" "$der2" "$der3
        sqlite3 ia.db "insert into vector_numerico (num_token, izq1, izq2, izq3, pal, der1, der2, der3, comentario) values ($token, '$izq1', '$izq2', '$izq3','$palabra', '$der1', '$der2', '$der3', '$comentario')"
done < vector_palabra.tmp
rm -rfv vector_palabra.tmp
echo "Vector Generado"


#GENERANDO 10 LOTES (Split / S)
clear
echo "Generando 10 Lotes (S)"
inicio=0
final=664
for i in `seq 1 10`;
do
        echo "Generando S$i.txt"
        sqlite3 ia.db "select num_token, izq1, izq2, izq3, pal, der1,der2,der3 from vector_numerico where id>"$inicio" and i$
        #echo "select * from vector_numerico where id>"$inicio" and id<"$final 
        inicio=$final
        let final=final+664
done

#GENERANDO 10 CONJUNTOS DE ENTRENAMIENTO
for i in `seq 1 10`;
do
        echo "Generando E$i.txt"
        for j in `seq 1 10`;
        do
                echo "E$1:"
                if [ "$i" -ne "$j" ];then
                        cat S$j".txt" >> E$i".txt"
                fi
        done
done


echo "Fin "
echo "Descague SVM LIGTH"
