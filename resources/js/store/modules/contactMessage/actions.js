import api from '../../../services/api';

export const send = (context, {form}) => {
    return new Promise((resolve,reject) => {
        api().post('contact', form).then(() => {
            resolve();
        }).catch((error) => {
            context.commit('SET_CONTACT_VALIDATION_ERRORS', error.response.data.errors['validation']);
            reject();
        });
    });
};
