import api from '../../../services/api';

export const getBrands = (context, payload) => {
    return new Promise((resolve) => {
        api().get('brands').then((response) => {
            context.commit('SET_BRANDS', response.data.data.brands);
            resolve();
        }).catch((error) => {
            console.log(error);
        });
    });
};
