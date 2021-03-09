import query from "../utils/query";

export const list = (params) => axios.get(`/characters?${query(params)}`);

export const update = (id, {name, gender, culture, url, died, born, created_at, updated_at}) =>
    axios.put(`/characters/${id}`, {name, gender, culture, url, died, born, created_at, updated_at});
