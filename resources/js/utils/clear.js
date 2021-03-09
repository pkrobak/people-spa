export default (object) => {
    const res = {};
    for (const propName in object) {
        if (object[propName]) {
            res[propName] = object[propName]
        }
    }

    return res
}
