package edu.sjsu.CMPE281;

public class Constants
{
	public static final int NO_OF_SENSORS = 1000;
	public static final int NO_OF_SENSOR_NODES = 50;
	public static final int NO_OF_CONTROL_NODES = 10;

	public static final int TEMPERATURE_SENSOR = 0;
	public static final int WEIGHT_SENSOR = TEMPERATURE_SENSOR + 1;
	public static final int GPS_SENSOR = WEIGHT_SENSOR + 1;
	public static final int TOTAL_NO_OF_SENSORS = GPS_SENSOR + 1;
	
	public static final String[] US_STATE_CODES = 
	{
		"CA", "LA", "AZ", "FL", "IL", "MA", "MI", "MN", "MS", "NE", "NY", "NC", "TX", "WA"
	};
	
	public static final int SECOND_TO_MILLI = 1000;
}