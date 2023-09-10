import { ref } from "vue";
import { useStore } from "vuex";

export function useFetch() {
    const data = ref([]);
    const loading = ref(false);
    const error = ref(null);
    const store = useStore();

    const getData = async (...params) => {
        loading.value = true;
        data.value = [];
        error.value = null;
        try {
            const response = await axios(...params);
            store.commit("setWordResponse", response.data.data);
            data.value = response.data.data;
        } catch (err) {
            const response = err.response.data;

            if (response.errors) {
                error.value = err.response.data.message;
            } else {
                error.value = err.response.data.error;
            }
        }
        loading.value = false;
    };

    return {
        data,
        loading,
        error,
        getData,
    };
}
