<template>
<k-list>

  <template v-if="title">
    <k-list-item :class="depth" :data="data" :text="title" :info="info" :showSlug="showSlug" :showStatus="showStatus" :treeMaxDepth="treeMaxDepth" :treeDefaultIcon="treeDefaultIcon" @click="goToPanelLocation(panel_url)"
    :icon="createIconSet(showPageIcon,iconEmoji,iconType,iconBack)"
     />
  </template>

  <table-view-cell v-for="(item, index) in data"
    :key="index"
    :data="item.child"
    :title="item.title"
    :showSlug="showSlug"
    :showStatus="showStatus"
    :showPageIcon="showPageIcon"
    :treeMaxDepth="treeMaxDepth"
    :treeDefaultIcon="treeDefaultIcon"
    :info="showPageSlug(item.slug) + ' ' + showPageStatus(item.status)"
    :panel_url="item.panel"
    :iconType="item.icon.type"
    :iconBack="item.icon.back"
    :iconEmoji="item.icon.emoji"
    @click="goToPanelLocation(item.panel)"
    :class="getMaxLevelDepth(item.depth-1) + ' ' + lastItem(index,data)"
    />
  </table-view-cell>

</k-list>
</template>

<script>
/*

  recusive vue template:
  - TableViewCell is recusive as long as item available in item.child

 */
export default {
  props: ['data', 'title', 'iconType', 'iconBack', 'iconEmoji', 'depth', 'panel_url', 'info', 'showSlug', 'showStatus', 'showPageIcon' ,'treeMaxDepth', 'treeDefaultIcon'],
  name: 'table-view-cell',
  methods: {
    lastItem: function(index,data) {
      return index==data.length-1 ? "last-item" : "item"
    },
    createIconSet: function(showPageIcon, iconEmoji, iconType, iconBack) {
      return this.showPageIcon == true ? { emoji: iconEmoji, type: iconType, back: iconBack} : { emoji: false, type: this.treeDefaultIcon, back: iconBack};
    },
    showPageStatus: function(status) {
      return this.showStatus == true ? '<span class=' + status + '></span>' : '';
    },
    showPageSlug: function(slug) {
      return this.showSlug == true ? slug : '';
    },
    goToPanelLocation: function(panelLink) {
      window.location.href = panelLink;
    },
    getMaxLevelDepth: function(currentDepth) {
      return currentDepth >= this.treeMaxDepth ? `level_hidden` : `level_${currentDepth}`;
    },
  },
}
</script>
<style lang="scss">
@import './src/scss/index.scss'
</style>