let Rp = (nominal = 0, symbol = '') => {
    return currency( nominal, {
        symbol: symbol,
        precision: 0
    }).format()
}