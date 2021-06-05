let smoothScroll = new scrollToSmooth('a', {
    targetAttribute: 'href',
    duration: 800,
    durationRelative: false,
    durationMin: false,
    durationMax: false,
    easing: 'easeOutBack',
    onScrollStart: (data) => { console.log(data); },
    onScrollUpdate: (data) => { console.log(data); },
    onScrollEnd: (data) => { console.log(data); },
    fixedHeader: null
})
smoothScroll.init();
