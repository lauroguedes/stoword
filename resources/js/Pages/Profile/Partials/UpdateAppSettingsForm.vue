<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { useForm, usePage } from "@inertiajs/vue3";

const user = usePage().props.auth.user;

const form = useForm({
    level: user.setting.level,
    qtd_sentences: user.setting.qtd_sentences,
    native_language: user.setting.native_language,
});

const updateSettings = () => {
    form.put(route("settings.update"), {
        preserveScroll: true,
    });
};
</script>

<style scoped>
    .select-style {
        @apply mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 text-gray-600 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm disabled:opacity-40
    }
</style>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                App Settings
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Update the app settings.
            </p>
        </header>

        <form @submit.prevent="updateSettings" class="mt-6 space-y-6">
            <div class="flex justify-between space-x-2">
                <div class="w-full">
                    <InputLabel for="level" value="English Level" />

                    <select
                        id="level"
                        v-model="form.level"
                        class="select-style"
                        required
                    >
                        <option value="A1">A1</option>
                        <option value="A2">A2</option>
                        <option value="B1">B1</option>
                        <option value="B2">B2</option>
                        <option value="C1">C1</option>
                        <option value="C2">C2</option>
                    </select>

                    <InputError class="mt-2" :message="form.errors.level" />
                </div>

                <div class="w-full">
                    <InputLabel for="qtd_sentences" value="Qtd. Sentences" />

                    <select
                        id="qtd_sentences"
                        v-model="form.qtd_sentences"
                        class="select-style"
                        required
                    >
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>

                    <InputError class="mt-2" :message="form.errors.qtd_sentences" />
                </div>

                <div class="w-full">
                    <InputLabel for="native_language" value="Native Language" />

                    <select
                        id="native_language"
                        v-model="form.native_language"
                        class="select-style"
                        required
                    >
                        <option value="pt-br">🇧🇷 Brazilian Portuguese</option>
                        <option value="pt">🇵🇹 Portuguese</option>
                        <option value="es">🇪🇸 Spanish</option>
                        <option value="fr">🇫🇷 French</option>
                        <option value="de">🇩🇪 German</option>
                        <option value="it">🇮🇹 Italian</option>
                        <option value="ja">🇯🇵 Japanese</option>
                        <option value="ko">🇰🇷 Korean</option>
                        <option value="ru">🇷🇺 Russian</option>
                        <option value="zh">🇨🇳 Chinese</option>
                    </select>

                    <InputError class="mt-2" :message="form.errors.native_language" />
                </div>
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition
                    enter-from-class="opacity-0"
                    leave-to-class="opacity-0"
                    class="transition ease-in-out"
                >
                    <p
                        v-if="form.recentlySuccessful"
                        class="text-sm text-green-700 dark:text-green-400"
                    >
                        Saved
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>
