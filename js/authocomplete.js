fetch('http://localhost/getauthors.php')
    .then((response) => response.json())
    .then(json => {
      input.addEventListener('focus', () => {filteringAuthors(json)});
      input.addEventListener('keyup', () => {filteringAuthors(json)});
    })
    .catch((e) => console.log('error'));


const compose = (...fns) => (data) => fns.reduceRight((value, func) => func(value), data);

const select = (selector) => document.querySelector(selector);

const input = select('#mySearch')

const datalist = select('#authorslist');

const createElem = (elem) => document.createElement(elem);

const toLower = (str) => str.toLowerCase();
const trim = (str) => str.trim();

let prettyStr = compose(toLower, trim);

function  filteringAuthors (arr) {
  let val = prettyStr(input.value);
  optVal = arr.find((str, i) => {
      return prettyStr(str).startsWith(val) ? str : null;
  })

  if(optVal) {
    // datalist.innerHTML = '';
    datalist.appendChild(createElem('option')).value = optVal;
  }
}

// function fixedEncodeURIComponent (str) {
//   return encodeURIComponent(str).replace(/[!'()*]/g, function(c) {
//     return '%' + c.charCodeAt(0).toString(16);
//   });
// }

// select('.authorsearch').addEventListener('click', function() {
//   input.value = fixedEncodeURIComponent(input.value);
// });


