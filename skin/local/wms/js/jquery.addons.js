// jQuery.fn.stripTags = function () {
//     return this.replaceWith(this.html().replace(/< /?[^>]+>/gi, ''));
// };


// Chunk-ing and Array
Array.range = function(n) {
  // Array.range(5) --> [0,1,2,3,4]
  return Array.apply(null,Array(n)).map((x,i) => i)
};
Object.defineProperty(Array.prototype, 'chunk', {
  value: function(n) {

    // ACTUAL CODE FOR CHUNKING ARRAY:
    return Array.range(Math.ceil(this.length/n)).map((x,i) => this.slice(i*n,i*n+n));

  }
});