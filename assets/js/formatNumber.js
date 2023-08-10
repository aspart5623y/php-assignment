const formatNumber = (payload) => {
    // remove sign if negative
    payload = parseFloat(payload).toFixed(2)
    var sign = 1;
    if (payload < 0) {
        sign = -1;
        payload = -payload;
    }
    // trim the number decimal point if it exists
    let num = payload.toString().includes('.') ? payload.toString().split('.')[0] : payload.toString();
    let len = num.toString().length;
    let result = '';
    let count = 1;
  
    for (let i = len - 1; i >= 0; i--) {
        result = num.toString()[i] + result;
      if (count % 3 === 0 && count !== 0 && i !== 0) {
            result = ',' + result;
      }
      count++;
    }
  
    // add number after decimal point
    if (payload.toString().includes('.')) {
        result = result + '.' + payload.toString().split('.')[1];

        // result = parseFloat(result + '.' + payload.toString().split('.')[1]).toFixed(2);
    }

    // return result with - sign if negative
    return sign < 0 ? '-' + result : result;
}
  