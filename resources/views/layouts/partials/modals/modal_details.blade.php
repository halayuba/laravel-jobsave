<details-modal
    v-show="showModal"
    @close="showModal=false"
 >
{{ $job->application->notes }}
</details-modal>
