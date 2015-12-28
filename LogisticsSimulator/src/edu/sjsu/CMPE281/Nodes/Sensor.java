package edu.sjsu.CMPE281.Nodes;

import java.util.Random;

import edu.sjsu.CMPE281.Constants;

public class Sensor
{
	private ControlNode controlNode = null;
	
	// sensor info
	private int sensorType = -1;
	private String sensorId = null;
	private String sensorInfo = null;
	private long timeStamp = -1;

	// latitude & longitude of truck
	private float truckLocationLatitude = 0.0f;
	private float truckLocationLongitude = 0.0f;

	// per second
	private float truckSpeed = 0.1f;

	// expected sensor data
	private String expectedSensorInfo = null;
	private int threshold = -1;

	// switch
	private boolean correctInfoSwitch = true;

	private int sensorInfoUpdateInterval = 1000;
	// timer
	private long timer = 0;

	private Random r = new Random();
	
	public void init(int index, ControlNode cNode)
	{
		controlNode = cNode;
		
		if (controlNode.isGPSSensorSet)
		{
			sensorType = r.nextInt(Constants.GPS_SENSOR);
		} else
		{
			sensorType = Constants.GPS_SENSOR;
			controlNode.isGPSSensorSet = true;
		}
		
		sensorId = "SENSOR_" + ((System.currentTimeMillis() % 10000) + index);
		
		expectedSensorInfo = "" + sensorId;
		threshold = 5;

		// truck location init
		// the below magic numbers are California's Latitude and Longitude
		truckLocationLatitude = r.nextFloat() * 30;
		truckLocationLongitude = r.nextFloat() * 100;

		truckSpeed = ((truckSpeed * sensorInfoUpdateInterval ) / Constants.SECOND_TO_MILLI);
	}

	public String getSensorId()
	{
		return sensorId;
	}

	public int getSensorType()
	{
		return sensorType;
	}
	
	public long getTimeStamp()
	{
		return timeStamp;
	}
	
	public void setUpdateInterval(int time)
	{
		sensorInfoUpdateInterval = time;
	}

	public void setExpectedValue(int value)
	{
		expectedSensorInfo = value + "";
	}

	public void setThreshold(int value)
	{
		threshold = value;
	}

	public void setCorrectInfoSwitch(boolean value)
	{
		correctInfoSwitch = value;
	}

	public String getSensorData()
	{
		return sensorInfo;
	}

	public void update(long time)
	{
		timer += time;

		if ((timer - sensorInfoUpdateInterval) >= 0)
		{
			timer = time;

			timeStamp = System.currentTimeMillis();
			switch (sensorType)
			{
				case Constants.TEMPERATURE_SENSOR:
				{
					float currTemp = r.nextFloat() * 80;//Float.parseFloat(expectedSensorInfo) + r.nextFloat();
					sensorInfo = correctInfoSwitch ? currTemp + "" : threshold + currTemp + "";
				}
					break;
				case Constants.WEIGHT_SENSOR:
				{
					float currWeight = r.nextFloat() * 80; //Float.parseFloat(expectedSensorInfo) + r.nextFloat();
					sensorInfo = correctInfoSwitch ? currWeight + "" : currWeight + threshold + "";
				}
					break;
				case Constants.GPS_SENSOR:
				{
					sensorInfo = (truckLocationLatitude + truckSpeed) + ", " + (truckLocationLongitude + truckSpeed);
				}
					break;
			}
		}
	}
}