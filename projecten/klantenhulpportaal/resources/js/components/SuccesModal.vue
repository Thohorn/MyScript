<script setup lang="ts">
import { useRouter } from 'vue-router';
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { CheckCircleIcon } from '@heroicons/vue/24/outline'

    const router = useRouter();

    defineProps<{ title: string, body: string, link: string, linkTo: string }>();
</script>

<template>
 <div>
      <Dialog class="relative z-10" :open="true">
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
          <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
              <DialogPanel class="place-content-centerrelative transform overflow-hidden rounded-lg bg-gray-800 text-left shadow-xl outline -outline-offset-1 outline-white/10 transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                  <!-- <div class="sm:flex sm:items-start"> -->
                    <div class="place-content-center flex">
                    <div class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-green-500/10 sm:mx-0 sm:size-10 ">
                      <CheckCircleIcon class="size-6 text-green-400" aria-hidden="true" />
                    </div>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:text-center">
                      <DialogTitle as="h3" class="text-base font-semibold text-white">{{ title }}</DialogTitle>
                      <div class="mt-2">
                        <p class="text-sm text-gray-400">{{ body }}</p>
                      </div>
                    <!-- </div> -->
                  </div>
                </div>
                <div class="bg-gray-700/25 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 place-content-center">
                  <router-link :to="{name: link}"><button type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white/10 px-3 py-2 text-sm font-semibold text-white inset-ring inset-ring-white/5 hover:bg-white/20 sm:mt-0 sm:w-auto">{{ linkTo }}</button></router-link>
                </div>
              </DialogPanel>
          </div>
        </div>
      </Dialog>
  </div>
</template>