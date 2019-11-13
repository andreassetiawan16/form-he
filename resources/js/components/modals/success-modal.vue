<template>
  <div>
    <modal name="success-modal" :width="500" :height="300">
      <sweetalert-icon icon="success" />
      <h4 class="text-center"><slot></slot></h4>
    </modal>
  </div>
</template>