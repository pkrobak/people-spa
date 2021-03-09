export default (params) => {
    return Object.keys(params)
        .map(param => `${param}=${params[param]}`)
        .join('&')
}
