import { ref } from "vue";

export function useFetch() {
    const data = ref([]);
    const loading = ref(false);
    const error = ref(null);

    const getData = async (...params) => {
        loading.value = true;
        data.value = [];
        error.value = null;
        try {
            const response = await axios(...params);
            data.value = response.data.data;
        } catch (err) {
            error.value = err.response.data.error;
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
