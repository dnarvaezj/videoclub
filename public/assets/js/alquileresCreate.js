setTimeout(() => {
    let valorTotal = 0;
    let diasAlquiler = 1;
    let peliculaArrTotal = [];
    
    let diasInput = document.getElementsByClassName('diasAlquiler');

    let totalInput = document.getElementsByClassName('valorTotal');
    
    let peliculas = document.getElementsByClassName('peliculas');
    peliculas[0].addEventListener('change', (e) => {
        console.log(e.target.options);


        for (let option of e.target.options) {

            if (option.selected) {
                let peliculaArr = option.label.split(' | ');
                let precio = parseInt(peliculaArr[1].slice(1));
                peliculaArr[1] = precio;
                
                peliculaArrTotal.push(peliculaArr);

            }
        }

        calculaTotal(peliculaArrTotal);
        peliculaArrTotal = [];

    });

    let calculaTotal = (peliculas) => {

        let subtotal = 0;

        let dias = parseInt(diasInput[0].value);
        console.log(dias);
        if (peliculas.length) {
            if (peliculas.length === 1) {
                subtotal = 0;
                totalInput[0].value = '';
            } 
                
            peliculas.forEach(element => {
                if (element[2] === 'Nueva'){
                    subtotal += element[1] * dias;
                }

                if (element[2] === 'Normal'){
                    let per = (element[1] / 100) * 15 ;
                    let diasN = 0;
                    subtotal += element[1] * dias;
                    if (dias > 3) {
                        diasN = dias - 3;
                        subtotal += diasN * per;
                    }
                }

                if (element[2] === 'Vieja'){
                    let per = (element[1] / 100) * 10 ;
                    let diasN = 0;
                    subtotal += element[1] * dias;
                    if (dias > 5) {
                        diasN = dias - 5;
                        subtotal += diasN * per;
                    }
                }

            });
            
            totalInput[0].value = subtotal;
        }
    }
    
}, 1000);