import { reactive } from "vue";
import { ref, isRef, toRefs, unref, watchEffect } from "vue";

export function useFetch(url) {
    // const data = ref(null);
    // const error = ref(null);

    const state = reactive({
        data: null,
        error: null,
    });

    function doFetch() {
        // reset state before fetching..
        state.data = null;
        state.error = null;
        // unref() unwraps potential refs
        fetch(unref(url))
            .then((res) => res.json())
            .then((json) => (state.data = json))
            .catch((err) => (state.error = err));
    }

    if (isRef(url)) {
        // setup reactive re-fetch if input URL is a ref
        watchEffect(doFetch);
    } else {
        // otherwise, just fetch once
        // and avoid the overhead of a watcher
        doFetch();
    }

    return { ...toRefs(state) };
}
