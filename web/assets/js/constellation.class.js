function Constellation(constellationPhp) 
{
	this.stars_ = [];
	var star;

	//$.each(constellationPhp.etoiles, function( nom_etoile, etoile )
	for(var nom_etoile in constellationPhp.etoiles) 
	{
		star = new Star(nom_etoile, constellationPhp.etoiles[nom_etoile].fournisseurList);
		this.stars_.push(star);
	}

	this.geocodeResult_ = constellationPhp['geocodeResult'];    

	this.markerHome_ = new google.maps.Marker({
		position: this.getOrigin(),
	});

	this.clusterLines_ = [];
}

Constellation.prototype.getOrigin = function () 
{
	return new google.maps.LatLng(this.geocodeResult_.coordinates.latitude, this.geocodeResult_.coordinates.longitude) ;
};

Constellation.prototype.getMarkerHome = function () 
{
	return this.markerHome_ ;
};

Constellation.prototype.getGeocodeResult = function () 
{
	return this.geocodeResult_;
};

Constellation.prototype.getStars = function () 
{
	return this.stars_ ;
};

Constellation.prototype.getStar = function (nom) 
{
	for(var i = 0; i < this.stars_.length; i++)
	{
		if (this.stars_[i].getNom() == nom) return this.stars_[i]
	}
	return null;
};

Constellation.prototype.getMarkers = function () 
{
	var array = [];
	for(var i = 0; i < this.stars_.length; i++)
	{
		if (this.stars_[i].getMarker() != null) array.push(this.stars_[i].getMarker());
	}
	return array;
};

Constellation.prototype.getMarkersIncludingHome = function () 
{
	var array = [];
	array.push(this.markerHome_);
	array = array.concat(this.getMarkers());
	return array;
};

Constellation.prototype.draw = function () 
{	
	var curr_star;
	var marker;

	for(var i = 0; i < this.stars_.length; i++)
	{
  		curr_star = this.stars_[i];

  		marker = createMarker(curr_star.getPosition(), curr_star.getFournisseur().id, curr_star.getName().toLowerCase());  		

  		//var polyline = drawLineBetweenPoints(marker_home, marker, fournisseur.type);

  		curr_star.setMarker(marker);
  		//etoile['line'] = polyline;

	}	
};

Constellation.prototype.drawLines = function () 
{
	var i, line;
	if (this.stars_ == null) return;

	// remove previous lines with clusters
	for (i = 0; i < this.clusterLines_.length; i++)
	{
		this.clusterLines_[i].setMap(null);
	}
	this.clusterLines_ = [];
		
	// draw line between stars not in cluster and origin
	for(var i = 0; i < this.stars_.length; i++)
	{
		this.stars_[i].setPolyline(null);
		
		if (!this.stars_[i].isClustered()) 
		{
			line = drawLineBetweenPoints(this.getOrigin(), this.stars_[i].getPosition(), this.stars_[i].getFournisseur().type)
			this.stars_[i].setPolyline(line);
		}
	}

	// draw lines with clusters
	if (GLOBAL.getClusterer() != null) 
	{
		var clusters = GLOBAL.getClusterer().getMinimizedClusters();
		
		for (i = 0; i < clusters.length; i++)
		{
			line = drawLineBetweenPoints(this.getOrigin(), clusters[i].getCenter(), 'cluster');
			this.clusterLines_.push(line);
		}
	}
}

Constellation.prototype.getStarFromName = function(name)
{
	for(var i = 0; i < this.stars_.length; i++)
	{		
		if (this.stars_[i].getName() == name) 
		{
			return this.stars_[i];
		}
	}

	return null;
}


