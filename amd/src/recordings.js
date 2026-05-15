define([], function () {

  const addCustomButtons = () => {
    const rows = document.querySelectorAll(".mod_bigbluebuttonbn_recordings_table tbody.yui3-datatable-data tr");

    rows.forEach(row => {
      // Prevent duplicate injection
      if (row.dataset.analyticsAdded === "1") {
        return;
      }

      // Find play button
      const playLink = row.querySelector(
        "a[data-action=\"play\"]",
      );

      if (!playLink) {
        return;
      }

      let rid = null;

      try {
        const url = new URL(playLink.href);
        rid = url.searchParams.get("rid");
      } catch (e) {
        return;
      }

      if (!rid) {
        return;
      }

      // Find action bar container
      const actionBar = row.querySelector(
        ".yui3-datatable-col-actionbar .d-flex",
      );

      if (!actionBar) {
        return;
      }

      // Wrapper
      const wrapper = document.createElement("div");

      // Create link
      const link = document.createElement("a");
      link.href = M.cfg.wwwroot + "/local/bbb/pages/open_dashboard.php?rid=" + encodeURIComponent(rid);
      link.className = "action-icon";
      link.target = "_blank";
      link.rel = "noopener noreferrer";
      link.setAttribute("title", M.util.get_string("open_dashboard", "local_bbb"));
      link.setAttribute("aria-label", M.util.get_string("open_dashboard", "local_bbb"));

      // Icon
      const icon = document.createElement("i");
      icon.className = "icon fa fa-chart-line fa-fw iconsmall"; // FontAwesome icon
      icon.setAttribute("title", M.util.get_string("open_dashboard", "local_bbb"));
      icon.setAttribute("role", "img");
      icon.setAttribute("aria-label", M.util.get_string("open_dashboard", "local_bbb"));

      link.appendChild(icon);
      wrapper.appendChild(link);
      actionBar.prepend(wrapper);

      row.dataset.analyticsAdded = "1";
    });
  };

  const init = () => {
    addCustomButtons();

    // Support dynamic table updates
    const observer = new MutationObserver(() => {
      addCustomButtons();
    });

    observer.observe(document.body, {
      childList: true,
      subtree: true,
    });
  };

  return {
    init: init,
  };
});