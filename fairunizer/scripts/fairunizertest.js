
(function () {

    //------------/view

    let view = (function () {

        let DOMstrings = {
            IdInputText: '#inputText',
            idToConvert: '#toConvert',
            classConvertedLetters: '.convertedLetters',
            ConvertedLetterClass: 'convertedLetters',
            classConvertedLetter: 'fLetter',
            idConvertedText: '#convertedText',
            idDeletePng: '#deletePng',
            toDeleteImgs: 'canvas',
            idConvertSize:'#convertSize',
            idWidth: '#widthConversion',
            idHeight: '#heightConversion',
            idGenPng: '#genPng'
        }

        return {

            getDOMstrings: function () {
                return DOMstrings;
            },

            createConversionText: function () {
                let toConvertLetters, convertedLetters;

                toConvertLetters = document.querySelector(DOMstrings.idToConvert).value;
                convertedLetters = document.createElement('div');
                convertedLetters.className = DOMstrings.ConvertedLetterClass;

                for (let letter of toConvertLetters) {
                    let divConvertedLetters = document.createElement('div');
                    divConvertedLetters.className = DOMstrings.classConvertedLetter;
                    divConvertedLetters.textContent = letter;
                    convertedLetters.appendChild(divConvertedLetters);
                }
                convertedText.appendChild(convertedLetters);
            },

            clearInput: function () {
                let convertedLetters = document.querySelector(DOMstrings.classConvertedLetters);
                if (convertedLetters) {
                    convertedText.removeChild(convertedLetters);
                }

            },

            convertSize: function () {
                let convertedLetters, toWidth, toHeight;
                
                convertedLetters = document.querySelector(DOMstrings.classConvertedLetters);
                toWidth = document.querySelector(DOMstrings.idWidth).value;
                toHeight = document.querySelector(DOMstrings.idHeight).value;
                if (convertedLetters) {
                    convertedLetters.style.width = toWidth + "px";
                    convertedLetters.style.height = toHeight + "px";
                }
            
                convertedText.style.width = parseInt(toWidth, 10) + 5 + "px";
                convertedText.style.height = parseInt(toHeight, 10) + 5 + "px";
            },

            genPng: function () {
                document.querySelector(DOMstrings.IdInputText).value = "";
            
                //canvas creation
                html2canvas(document.querySelector(DOMstrings.idConvertedText)).then(canvas => {
                    imageZone.appendChild(canvas)
                });
            },

            deletePng: function () {
                let toDeleteImgs = document.querySelectorAll(DOMstrings.toDeleteImgs);
                if (toDeleteImgs) {
                    toDeleteImgs.forEach(function (toDeleteImg) {
                        imageZone.removeChild(toDeleteImg);
                    });
                }
            }
            


        }


    })();

    //----------/view

    //----------controller
    let controller = (function (view) {
        

        let setupEventListenners = function () {
            let DOM = view.getDOMstrings();

            document.querySelector(DOM.IdInputText).addEventListener('submit', ctrlConvertText);

            document.querySelector(DOM.idToConvert).addEventListener('submit', function (evt){
                evt.preventDefault();
                view.clearInput();
            });

            document.querySelector(DOM.idConvertSize).addEventListener('submit', function (evt){
                evt.preventDefault();
                view.convertSize();
            });

            document.querySelector(DOM.idGenPng).addEventListener('submit', function (evt){
                evt.preventDefault();
                view.genPng();
            });
            
            document.querySelector(DOM.idDeletePng).addEventListener('submit', function (evt){
                evt.preventDefault();
                view.deletePng();
            });

        };
        
        let ctrlConvertText = function (evt) {
            evt.preventDefault();
            if (document.querySelector(view.DOMstrings.idToConvert).value){
                createConversionText();
            }
        };

        return {
            init: function () {
                setupEventListenners();
            }
        };


    })(view);
    controller.init();

})()

// //Selection of the text
// let inputText = document.getElementById("inputText");

// inputText.addEventListener('submit', function (evt) {
//     evt.preventDefault();
//     let toConvert = document.getElementById("toConvert").value;
//     //creation of the container div
//     let convertedLetters = document.createElement('div');
//     convertedLetters.className = "convertedLetters";
//     // each letter is added in a new div
//     for (let letter of toConvert) {
//         let divConvertedLetters = document.createElement('div');
//         divConvertedLetters.className = "fLetter";
//         divConvertedLetters.textContent = letter;
//         convertedLetters.appendChild(divConvertedLetters);
//     };
//     // container div added to the dom
//     convertedText.appendChild(convertedLetters);
// });

// //clear the conversion zone
// toConvert.addEventListener('focus', function (evt) {
//     evt.preventDefault();
//     let convertedLetters = document.querySelector('.convertedLetters');
//     if (convertedLetters) {
//         convertedText.removeChild(convertedLetters);
//     }
// });


// // size of the converted text zone
// let convertSize = document.getElementById("convertSize");

// convertSize.addEventListener('submit', function (evt) {
//     evt.preventDefault();
//     let convertedLetters = document.getElementsByClassName("convertedLetters")[0];
//     let fWidth = document.getElementById("widthConversion").value;
//     let fHeight = document.getElementById("heightConversion").value;
//     if (convertedLetters) {
//         convertedLetters.style.width = fWidth + "px";
//         convertedLetters.style.height = fHeight + "px";
//     }

//     convertedText.style.width = parseInt(fWidth, 10) + 5 + "px";
//     convertedText.style.height = parseInt(fHeight, 10) + 5 + "px";
// });


// //validate the conversion to create image
// let genPng = document.getElementById("genPng");

// genPng.addEventListener('submit', function (evt) {
//     evt.preventDefault();
//     document.querySelector('input').value = "";

//     //canvas creation
//     html2canvas(document.getElementById('convertedText')).then(canvas => {
//         imageZone.appendChild(canvas)
//     });
// });

// //deleting of the images
// let deletePng = document.getElementById("deletePng");
// deletePng.addEventListener('submit', function (evt) {
//     evt.preventDefault();
//     let toDeleteImgs = document.querySelectorAll('canvas');
//     if (toDeleteImgs) {
//         toDeleteImgs.forEach(function (toDeleteImg) {
//             imageZone.removeChild(toDeleteImg);
//         });
//     }
// });