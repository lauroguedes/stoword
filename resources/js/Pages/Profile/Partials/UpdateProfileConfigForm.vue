<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Link, useForm, usePage } from "@inertiajs/vue3";

const user = usePage().props.auth.user;

const form = useForm({
    gpt_api_key: user.gpt_api_key,
});

const updateConfig = () => {
    form.patch(route("profile.update"), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.gpt_api_key) {
                form.reset("gpt_api_key");
                gptApiKeyInput.value.focus();
            }
        },
    });
};
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Profile Configuration
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Update your account's profile configuration like API Key and
                others.
            </p>
        </header>

        <form @submit.prevent="updateConfig" class="mt-6 space-y-6">
            <div>
                <InputLabel for="gpt_api_key" value="Open AI Key" />

                <TextInput
                    id="gpt_api_key"
                    type="password"
                    ref="gptApiKeyInput"
                    class="mt-1 block w-full"
                    v-model="form.gpt_api_key"
                    placeholder="sk-*****"
                    required
                    autocomplete="gpt_api_key"
                />

                <InputError class="mt-2" :message="form.errors.gpt_api_key" />

                <p class="text-gray-500 text-sm mt-1">
                    Create an account at
                    <a
                        target="_blank"
                        class="underline hover:opacity-90"
                        href="https://platform.openai.com/"
                        >Open AI Platform</a
                    >
                    and create an
                    <a
                        target="_blank"
                        class="underline hover:opacity-90"
                        href="https://bit.ly/45IuaOd"
                        >API Key</a
                    >
                    <div class="mt-2">Our system prioritizes the security and privacy of user
                    data. The API key is stored in our database in an encrypted
                    form, with robust protection measures and restricted access,
                    ensuring the confidentiality of information.</div>
                </p>
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
