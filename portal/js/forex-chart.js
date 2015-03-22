jQuery(function ($) {
    var USDJPY = [],
    USDGBP = [],
    GBPJPY = [],
    EURGBP = [];

    function createUSDJPYChart() {
        $("#USDJPYChart").shieldChart({
            seriesSettings: {
                line: {
                    applyAnimation: false,
                    pointMark: {
                        enabled: false
                    }
                }
            },
            tooltipSettings: {
                enabled: true
            },
            exportOptions: {
                image: false,
                print: false
            },
            primaryHeader: {
                text: "USD/JPY"
            },
            dataSeries: [{
                seriesType: "line",
                collectionAlias: "USD/JPY",
                data: USDJPY
            }]
        });
    }

    function createUSDGBPChart() {
        $("#USDGBPChart").shieldChart({
            seriesSettings: {
                area: {
                    applyAnimation: false,
                    pointMark: {
                        enabled: false
                    }
                }
            },
            tooltipSettings: {
                enabled: false
            },
            exportOptions: {
                image: false,
                print: false
            },
            primaryHeader: {
                text: "USD/GBP"
            },
            dataSeries: [{
                seriesType: "area",
                collectionAlias: "USD/GBP",
                data: USDGBP
            }]
        });
    }

    function createGBPJPYChart() {
        $("#GBPJPYChart").shieldChart({
            seriesSettings: {
                area: {
                    applyAnimation: false,
                    pointMark: {
                        enabled: false
                    }
                }
            },
            tooltipSettings: {
                enabled: true
            },
            exportOptions: {
                image: false,
                print: false
            },
            primaryHeader: {
                text: "GBP/JPY"
            },
            dataSeries: [{
                seriesType: "area",
                collectionAlias: "GBP/JPY",
                data: GBPJPY
            }]
        });
    }
    

    function createEURGBPChart() {
        $("#EURGBPChart").shieldChart({
            seriesSettings: {
                area: {
                    applyAnimation: false,
                    pointMark: {
                        enabled: false
                    }
                }
            },
            tooltipSettings: {
                enabled: true
            },
            exportOptions: {
                image: false,
                print: false
            },
            primaryHeader: {
                text: "EUR/GBP"
            },
            dataSeries: [{
                seriesType: "line",
                collectionAlias: "EUR/GBP",
                data: EURGBP
            }]
        });
    }

    function updateCharts() {
        updateUSDJPYChart();
        updateUSDGBPChart();
        updateGBPJPYChart();
        updateEURGBPChart();
    }

    function updateUSDJPYChart() {
        USDJPY.shift();
        USDJPY.push(getRandomRange(80, 100));

        var container = $("#USDJPYChart").swidget();
        if (container) {
            container.destroy();
        }

        createUSDJPYChart();
    }

    function updateUSDGBPChart() {
        USDGBP.shift();
        USDGBP.push(getRandomRange(0.6, 0.7));

        var container = $("#USDUSDGBPChart").swidget();
        if (container) {
            container.destroy();
        }

        createUSDGBPChart();
    }

    function updateGBPJPYChart() {
        GBPJPY.shift();
        GBPJPY.push(getRandomRange(80, 100));

        var container = $("#GBPJPYChart").swidget();
        if (container) {
            container.destroy();
        }

        createGBPJPYChart();
    }

    function updateEURGBPChart() {
        EURJPY.shift();
        EURJPY.push(getRandomRange(80, 100));

        var container = $("#EURJPYChart").swidget();
        if (container) {
            container.destroy();
        }

        createEURJPYChart();
    }

    function getRandomRange(min, max) {
        return Math.random() * (max - min) + min;
    }

    for (var index = 0; index < 50; index++) {
        USDJPY.push(getRandomRange(80, 100));
        USDGBP.push(getRandomRange(0.6, 0.7));   
        GBPJPY.push(getRandomRange(60, 100));
        EURGBP.push(getRandomRange(80, 100));         
    }

    createUSDJPYChart();
    createUSDGBPChart();
    createGBPJPYChart();
    createEURGBPChart();

    setInterval(function () { updateCharts() }, 1000);
});