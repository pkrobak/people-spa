export const PER_PAGE = 10;
const FIRST_PAGE = 1;

export const getPageById = (id, perPage = PER_PAGE) => {
    if (Number.isNaN(id)) {
        return FIRST_PAGE;
    }

    return Math.ceil(id / perPage)
};
