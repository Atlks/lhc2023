

betstr_a=['闲','庄']
mny= Random(10,100)
console.log(betstr_a[Random(0,1)])
console.log(mny)






betstr_a=['闲','庄']
mny0_a=[100,1000]

mny= Random(1,9)
nmy0=mny0_a[Random(0,1)]

let btstr = betstr_a[Random(0,1)];
let fnlMny=mny*nmy0;

console.log(btstr+fnlMny+"{enter}")



function Random(min, max) {
    return Math.round(Math.random() * (max - min)) + min;
}